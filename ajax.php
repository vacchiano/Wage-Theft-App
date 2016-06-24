<?php
    include_once('config.php');
	include_once('dbutils.php');

    $searchVal = $_POST['searchVal'];
    $db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);

    $query = "SELECT e.email, e.name, j.hourlyPay, j.jobTitle, c.parentCompany
              FROM Employee e, Job j, Company c
              WHERE e.email=j.email AND j.companyID=c.companyID AND LOWER(c.parentCompany)='$searchVal'";
    $result = queryDB($query, $db);
    $tableRows = '';
    while ($row = nextTuple($result)) {
        $email = $row['email'];
        $name = $row['name'];
        $salary = $row['hourlyPay'];
        $job = $row['jobTitle'];
        $company = $row['parentCompany'];
        
        $tableRow = '<tr>
                        <td>'.$email.'</td>
                        <td>'.$name.'</td>
                        <td>$'.$salary.'</td>
                        <td>'.$job.'</td>
                        <td>'.$company.'</td>
                    </tr>';
        $tableRows .= $tableRow;
    }
	if ($tableRows) {
	    echo $tableRows;
	} else {
		echo "error";
	}
?>