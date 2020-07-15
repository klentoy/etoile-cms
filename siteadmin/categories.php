<?php
include_once "inc/admin.config.inc.php";
include "inc/connect.php";

$blogs = new Blogs;
?>
<?php include "layout/admin-header.php"; ?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Blog Posts</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($blogs->get_posts() as $post) { ?>
                        <tr>
                            <td><?php echo $post->title; ?></td>
                            <td><?php echo $post->startdate; ?></td>
                            <td>
                                <a href="<?php echo BASE_ADMIN_URL . '/add-blogpost.php?post=' . $post->id; ?>" type="button" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?php echo BASE_ADMIN_URL . '/add-blogpost.php?post=' . $post->id; ?>" type="button" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>