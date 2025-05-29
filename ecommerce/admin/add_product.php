<?php 
    
    require('connection.inc.php');
    

    $categories_id = '';
    $name = "";
    $mrp = "";
    $price = "";
    $qty = "";
    $image = "";
    $short_desc = "";
    $description = "";
    $meta_title = "";
    $meta_desc = "";
    $meta_keyword = "";

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
        echo "<pre>";
        print_r($_POST);die;
        
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
                   
                    <div class="col-lg-12 col-md-8 col-sm-12">
                         
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Add Product</strong>
                               
                            </div>
                            <div class="card-body">
                                <form method="post">

                                    <div class="mb-3">
                                        <label for="categories" class="form-label">Categories</label>
                                        <select name="categories" class="form-control" required>
                                            <option value="">---select categories--</option>
                                            <?php
                                                $sql = "SELECT * FROM `categories`";
                                                $res = mysqli_query($con,$sql);
                                                while($row = mysqli_fetch_array($res)){
                                             ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['categories'] ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter name" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Mrp</label>
                                        <input type="text" class="form-control" name="mrp" value="<?php echo $mrp; ?>" placeholder="Enter mrp" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" placeholder="Enter price" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Qty</label>
                                        <input type="text" class="form-control" name="qty" value="<?php echo $qty; ?>" placeholder="Enter qty" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" required>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Short Desc</label>
                                        <textarea name="short_desc" class="form-control" placeholder="Enter short description" required><?php echo $short_desc; ?></textarea>
                                    </div>

                                     <div class="mb-3">
                                        <label for="name" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Enter description" required><?php echo $description; ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Meta title</label>
                                        <textarea name="meta_title" class="form-control" placeholder="Enter meta title" required><?php echo $meta_title; ?></textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="name" class="form-label">Meta description</label>
                                        <textarea name="meta_desc" class="form-control" placeholder="Enter meta description" required><?php echo $meta_desc; ?></textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="name" class="form-label">Meta Keyword</label>
                                        <textarea name="meta_keyword" class="form-control" placeholder="Enter meta keyword" required><?php echo $meta_keyword; ?></textarea>
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