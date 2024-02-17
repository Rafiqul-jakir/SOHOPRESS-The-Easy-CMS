<?php
  require "../layouts/header.php";
  require "../../config/config.php";


  if(!isset($_SESSION['admin_email'])){
    header("location: ".ADMINURL."");
  }
  $cmnt_query = $conn->query("SELECT * FROM comments ORDER BY created_at DESC");
  $cmnt_query->execute();
  $comments = $cmnt_query->fetchAll(PDO::FETCH_OBJ);


  ?>
    <div class="container-fluid">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Comments</h5>
            
              <table class="table table-hover">
                <thead>
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Post ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                    <th scope="col">View Post</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($comments as $comments): ?> 
                    <tr class="text-center">
                        <th scope="row"><?php echo $comments->ID ?></th>
                        <td><?php echo $comments->comment ?></td>
                        <td><?php echo $comments->post_id ?></td>
                        <td><?php echo $comments->user_name ?></td>
                        <?php if($comments->status == 0): ?>
                            <td><a href="update-status.php?post_s_id=<?php echo $comments->ID ?>" class="btn btn-primary  text-center ">Pending</a></td>
                        <?php else: ?>
                            <td><a href="update-status.php?post_s_id=<?php echo $comments->ID ?>" class="btn btn-success  text-center ">Approved</a></td>
                        <?php endif; ?>
                        <td><a href="delete_comment.php?comment_d_id=<?php echo $comments->ID ?>" class="btn btn-danger  text-center ">delete</a></td>
                        <td><a href="../../posts/post.php?post_id=<?php echo $comments->post_id ?>" target="_blank" class="btn btn-success  text-center ">View</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
<script type="text/javascript">

</script>
</body>
</html>