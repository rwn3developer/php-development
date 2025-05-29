<?php 
    
    require('connection.inc.php');
    

    $categories = '';
    $msg = '';
    if(isset($_GET['id']) &&  $_GET['id']!=''){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `categories` WHERE `id`='$id'";
        $res = mysqli_query($con,$sql);

        $check = mysqli_num_rows($res);
        
        if($check > 0){
             $row = mysqli_fetch_array($res);
             $categories = isset($row['categories']) ? $row['categories'] : '';
        }else{
            header('location:categories.php');
            die();
        }

       
    }

    if(isset($_POST['submit'])){
        $categories = $_POST['categories'];

         $sql = "SELECT * FROM `categories` WHERE `categories`='$categories'";
        
         $res = mysqli_query($con,$sql);

         $check = mysqli_num_rows($res);
        //  echo $check;
         if($check > 0){
            $msg = "Category already exists";
         }else{
            if(isset($_GET['id']) && $_GET['id']!=''){
                $sql = "UPDATE `categories` SET `categories`='$categories' WHERE `id`='$id'";
            }else{
                $sql = "INSERT INTO `categories` (`categories`,`status`) VALUES ('$categories','1')";
            }
             $res = mysqli_query($con,$sql);
         }
         echo "<script>
                    setTimeout(()=>{
                        window.location.href='categories.php'; 
                    },2000);
                </script>";
    }
    require('header.inc.php'); 
?>


 <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                   
                    <div class="col-lg-6 col-md-8 col-sm-12">
                         
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Add Categories</strong>
                               
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="mb-3">
                                        <label for="categories" class="form-label">Categories</label>
                                        <input type="text" name="categories" class="form-control" value="<?php echo $categories; ?>" placeholder="Enter Category" required>
                                    </div>
                                    
                                    
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <hr>
                                <?php
                                    if(isset($msg)){ ?>
                                        <p><?php echo $msg; ?></p>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
            </div>




          

            

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>


<?php require('footer.inc.php'); ?>