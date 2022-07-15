<?php
include_once('storage.php');
include_once('userstorage.php');
include_once('employeestorage.php');
include_once('auth.php');

session_start();
$auth = new Auth(new UserStorage());

$isadmin=false;

if ($auth->is_authenticated()){
    if (in_array("admin", $auth->authenticated_user()['roles'])){
        $isadmin=true;
    }
}

$employeeStorage = new EmployeeStorage();
$userStorage = new UserStorage();




$personid = $auth-> authenticated_user()['personid'];
$employee = $employeeStorage->findOne(['personid'=>$personid]);
//echo $employee['vacation'];


$inp = file_get_contents("employee_vac_json/".$auth->authenticated_user()['personid'].".json");
$tempArray = json_decode($inp);

$sum=0;
foreach ($tempArray as $value){
    $sum=$sum+$value->vachour;
}
echo $sum;





//------------------------------------------------------------------------------------------------



$data = [];
$errors = [];

$year_month = str_replace("-",":",$_GET['ym']);
if (count($_POST) > 0) {

        
        $url_date = $year_month . ":" . $_GET['day'];

        $data['date'] = $url_date;
    
        if(isset($_POST['wholeday'])){
            $data['wholeday'] = $_POST['wholeday'];
            $data['vachour']=8;
            $data['from'] = 8;
            $data['to'] = 16;
        }
        else{
            $data['wholeday'] = false;

            $data['from'] = $_POST['from'];
            $data['to'] = $_POST['to'];

            $data['vachour'] = $data['to']-$data['from'];
        }

        $inp = file_get_contents("employee_vac_json/".$auth->authenticated_user()['personid'].".json");
        $tempArray = json_decode($inp);
        $realArray = (array)$tempArray;
        array_push($realArray, $data);
        $jsonData = json_encode($realArray);
        file_put_contents("employee_vac_json/".$auth->authenticated_user()['personid'].".json", $jsonData);

        
        /* header('Location: index.php?');
        exit(); */
}    
//-----------------------------------------------------------------------------------------------------------



// Set your timezone
date_default_timezone_set('Europe/Budapest');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);


// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 0, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);
$vac_day=false;
for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $vac_day=false;
    $date = $ym . '-' . $day;
    $cur_date = $year_month . ":" . $day;
    foreach ($tempArray as $value){
        if($value->date==$cur_date){
            $vac_day=true;
        }
    }

    if(!$vac_day){
        if ($today == $date) {
            $week .= '<td class="today">' . $day;
        } else if($_GET['day']==$day){
            $week .= '<td class="selected">' . $day;
        }  
        else {
            $week .= '<td>' . $day;
        }
    }else{
        $week .= '<td class="vacday">' . $day;
    }
        

    $week .= '</td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: 80px;
        }
        h3 {
            margin-bottom: 30px;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 100px;
        }
        .today {
            background: grey;
        }
        .selected {
            background: orange;
        }
        .vacday {
            background: red;
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: red;
        }
        th:nth-of-type(6), td:nth-of-type(6) {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 id="title"><a href="?ym=<?php echo $prev; ?>&day=<?php echo date('d', $timestamp) ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>&day=<?php echo date('d', $timestamp) ?>">&gt;</a></h3>
        <table class="table table-bordered">
            <tr>
                <th>H</th>
                <th>K</th>
                <th>Sz</th>
                <th>Cs</th>
                <th>P</th>
                <th>Sz</th>
                <th>V</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>

    

        <script>
            const tbody = document.querySelector('table');
            
            tbody.addEventListener('click', function (e) { 
                /* for (var i = 0, cell; cell = tbody.cells[i]; i++) {
                    //iterate through cells
                    //cells would be accessed using the "cell" variable assigned in the for loop
                    cell.classList.remove("selected");
                } */

                for (var i = 0, roow; roow = tbody.rows[i]; i++) {
                    //iterate through rows
                    //rows would be accessed using the "row" variable assigned in the for loop
                    for (var j = 0, col; col = roow.cells[j]; j++) {
                        //iterate through columns
                        //columns would be accessed using the "col" variable assigned in the for loop
                        col.classList.remove("selected");
                    }  
                    }
                


                const cur_cell = e.target.closest('td');
                if (!cur_cell) {return;} // Quit, not clicked on a cell
                const row = cur_cell.parentElement;
                cur_cell.classList.add('selected');
                //cur_cell.setAttribute("class","selected");
                //console.log(cur_cell.innerHTML, row.rowIndex, cur_cell.cellIndex);
                
                const queryString = window.location.search;
                console.log(queryString);
                const urlParams = new URLSearchParams(queryString);
                
                window.location.replace("calendar.php?ym="+urlParams.get('ym')+"&day="+cur_cell.innerHTML)
            });
        </script>
 

        <h4>Szabadság megadása:</h4><br>
        <form action="" method="post">
           
            <input type="checkbox" name="wholeday" id="wholeday">
            <label for="wholeday">Teljes nap</label>

            <br><br>
            <p>Mettől:</p>
            <select name="from" id="from" enabled>
                <option value="8">8:00</option>
                <option value="9">9:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
            </select>


            <br><br>
            <p>Meddig:</p>
            <select name="to" id="to">
                <option value="9">9:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
            </select>

            <script>
                var wholeday = document.getElementById('wholeday');
                var from = document.getElementById('from');
                var to = document.getElementById('to');

                wholeday.addEventListener('change', (event) => {      
                    document.getElementById('from').disabled = wholeday.checked ? true : false;
                    document.getElementById('to').disabled = wholeday.checked ? true : false;
                });

            </script>

            <br><br>
            <button>Mentés</button>
        </form>


    </div>
</body>
</html>