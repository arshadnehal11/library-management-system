<?php
session_start();
include"connection.php";
include"header.php";
?>

        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3></h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style=".......">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Issue Books </h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form name="form1" action="" method="post">

                                <table>
                                    
                                        <tr>
                                            <td>
                                                <select name="enr"class="form-control selectpicker">


                                                   <?php

                                                $res=mysqli_query($link,"SELECT enrollmentno FROM student_registration");

                                                while($row=mysqli_fetch_array($res))
                                                {

                                                    echo "<option>";
                                                    echo $row["enrollmentno"];
                                                    echo "</option>";
                                                }


                                                   ?>
                                                    
                                                </select>
                                                
                                            </td>
                                            <td>
                                                
                                                <input type="submit" value="Search" name="submit1" class="form-control btn btn-default" style="margin-top: 5px">
                                            </td>
                                        </tr>


                                </table>
                              <?php
                              if(isset($_POST["submit1"])){

                                $res5=mysqli_query($link,"SELECT * FROM student_registration where enrollmentno=$_POST[enr]");
                                while($row5=mysqli_fetch_array($res5)) 
                                 {
                                    $firstname=$row5["firstname"];
                                    $lastname=$row5["lastname"];
                                    $username=$row5["username"];
                                    $email=$row5["email"];
                                    $contact=$row5["contact"];
                                    $sem=$row5["sem"];
                                    $enrollmentno=$row5["enrollmentno"];
                                    $_SESSION["enrollmentno"]=$enrollmentno;
                                    $_SESSION["username"]=$username;

                                    
                                }


                                ?>
                <table class="table table-bordered">
                    <tr>
                         <td>
                            <input type="text" class="form-control" placeholder="enrollmentno" name="enrollmentno" value="<?php echo $enrollmentno;?>" disabled> 
                        </td>
                    </tr>


                    <tr>
                         <td>
                            <input type="text" class="form-control" placeholder="studentname"name="studentname" value="<?php echo $firstname.' '.$lastname;?> " required> 
                        </td>
                    </tr>


                    <tr>
                         <td>
                            <input type="text" class="form-control" placeholder="studentsem" name="studentsem" value="<?php echo $sem ;?>" required> 
                        </td>
                    </tr>


                    <tr>
                         <td>
                            <input type="text" class="form-control" placeholder="studentcontact" name="studentcontact" value="<?php echo $contact ;?>" required> 
                        </td>
                    </tr>


                     <tr>
                         <td>
                            <input type="text" class="form-control" placeholder="studentemail" name="studentemail" value="<?php echo $email  ;?>" required> 
                        </td>
                    </tr>


                     <tr>
                         <td>
                           <select name="booksname" class="form-control selectpicker">
                           <?php
                                $res = mysqli_query($link,"SELECT books_name FROM add_books");
                                while ($row = mysqli_fetch_array($res)) {

                                    echo "<option>";

                                    echo $row["books_name"];

                                    echo "</option>";




                                }
                               
                            ?>

                           </select>
                        </td>
                    </tr>

                    <tr>
                         <td>
                            <input type="text" class="form-control" placeholder="booksissuedate" name="booksissuedate" value="<?php echo date("d-m-yy");?>" required> 
                        </td>
                    </tr>


                    <tr>
                         <td>
                            <input type="text" class="form-control" placeholder="studentusername" name="studentusername" value="<?php echo $username ;?>" disabled> 
                        </td>
                    </tr>


                    <tr>
                         <td>
                            <input type="submit" value="issuebooks"name="submit2" class="form-control btn btn-default"  style="background-color: skyblue;color: black"> 
                        </td>
                    </tr>


                </table>

                                <?php
                              }

                              ?>






                                </form>
                                <?php
                                if(isset($_POST["submit2"]))
                                {
                                    $qty=0;
                                    $res=mysqli_query($link,"select * from add_books where books_name='$_POST[booksname]'");
                                    while ($row=mysqli_fetch_array($res))
                                     {
                                        $qty=$row["available_qty"];
                                        
                                    }
                                    if ($qty==0)
                                     {
                                        ?>

    <div class="alert alert-danger col-lg-6 col-lg-push-3">
    <strong style="....">This book are not available in stock</strong>
</div>

    <?php
                                        
                                    }
                                    else
                                    {
                                    mysqli_query($link,"insert into issue_books value('','$_SESSION[enrollmentno]','$_POST[studentname]','$_POST[studentsem]','$_POST[studentcontact]','$_POST[studentemail]','$_POST[booksname]','$_POST[booksissuedate]','',' $_SESSION[username]')");
                                    mysqli_query($link,"update add_books set available_qty=available_qty-1 where books_name='$_POST[booksname]'");

                                     ?>


            <script type="text/javascript">
             alert("books Issued successfully");
             window.location.href=window.location.href;


            </script>
            <?php
                 }
             }

                    

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <?php
        include"footer.php";
        ?>


       
