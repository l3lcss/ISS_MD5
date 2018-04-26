<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>

    </title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style media="screen">
    @import url('https://fonts.googleapis.com/css?family=Roboto');
      #mainForm{
        margin: auto;
        margin-top: 4%;
        font-family: 'Roboto', sans-serif;
        font-size: 100px;
      }
      #mainForm input[type="text"]{
        font-family: 'Roboto', sans-serif;
        width: 90%;
        padding-left: 5%;
        font-size: 100px;
      }
      #mainForm input[type="password"]{
        font-family: 'Roboto', sans-serif;
        width: 90%;
        padding-left: 5%;
        font-size: 100px;
      }

      #btnOK{
        margin-top: 3%;
        width: 97%;
        padding: 4% 0% 4% 0%;
        font-family: 'Poppins', sans-serif;
        font-size: 120px;
        font-weight: bold;
        color: #fff;
        background-color: #000;
        border: none;
        transition: all 0.5s;
      }
      #btnOK:hover{
        color: #000;
        background-color: #ccc;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "HSA1";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST["REGIS"])){
      $PASS_IP = $_POST["pass"];
      $digest = md5($PASS_IP);

      $sql = "INSERT INTO user (username, password_md5)
      VALUES ('$_POST[username]', '$digest')";
      $a = $_POST["username"];
      if ($conn->query($sql) === TRUE) {
?>
      <script type="text/javascript">
        var jsvar = <?php echo json_encode($a); ?>;
        swal("INSERT SUCCESSFULL", "...your username is " + jsvar);
      </script>
<?php
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }


    }

    if(isset($_POST["OK"])){
      $pass_IP = $_POST["pass"];
      $pass_IP_digest = md5($pass_IP);

      $sql = "SELECT * FROM user WHERE USERNAME = '$_POST[username]' AND PASSWORD_MD5 = '$pass_IP_digest'";
      $result = $conn->query($sql);
      //echo "sql = $sql <br>";

      if ($result->num_rows > 0) {
        $a = $_POST["username"];
        ?>
              <script type="text/javascript">
                var jsvar = <?php echo json_encode($a); ?>;
                swal("LOGIN SUCCESSFULL", "...your username is " + jsvar);
              </script>
        <?php
      } else {
        ?>
              <script type="text/javascript">
                swal("LOGIN FAILED" , "USERNAME OR PASSWORD does not exist");
              </script>
        <?php
      }

    }

    $conn->close();
    ?>
    <form action="#" method="post">
      <table id="mainForm" border="0">
        <tr>
          <td>USERNAME </td>
          <td><input type="text" name="username" /></td>
        </tr>
        <tr>
          <td>PASSWORD </td>
          <td><input type="password" name="pass" /></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="OK" value=" LOGIN " id="btnOK">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="REGIS" value=" REGISTER " id="btnOK">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
