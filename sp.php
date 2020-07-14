<?php
    $serverName = "ip_server";
    $connectionInfo = array( "Database"=>"database", "UID"=>"user_db", "PWD"=>"password_db");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn === false )
    {
        echo "Could not connect.\n";
        print('<pre>');
        die( print_r( sqlsrv_errors(), true));
        print('</pre>');
    }

    /*--------- The next few steps call the stored procedure. ---------*/

    /* Define the Transact-SQL query. Use question marks (?) in place of
    the parameters to be passed to the stored procedure */
    $tsql_callSP = "{call InsertUser(?,?,?,?)}";

    /* Define the parameter array. By default, the first parameter is an
    INPUT parameter. The second parameter is specified as an INOUT
    parameter. Initializing $vacationHrs to 8 sets the returned PHPTYPE to
    integer. To ensure data type integrity, output parameters should be
    initialized before calling the stored procedure, or the desired
    PHPTYPE should be specified in the $params array.*/
    
    $date = date("Y-m-d");

    $Title = 'value';
    $FirstName = 'value';
    $LastName = 'value';
    $Email = 'value';

    $params = array(
        array($Title, SQLSRV_PARAM_IN),
        array($FirstName, SQLSRV_PARAM_IN),
        array($LastName, SQLSRV_PARAM_IN),
        array($Email, SQLSRV_PARAM_IN)
    );

    /* Execute the query. */
    $stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
    if( $stmt === false )
    {
        echo "Error in executing statement.\n";
        die( print_r( sqlsrv_errors(), true));
    }

    /*Free the statement and connection resources. */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
?>
