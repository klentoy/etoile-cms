<?php
include_once "inc/admin.config.inc.php";
include "inc/connect.php";

$blogs = new Blogs;
$blogs->save_post();
$blog = $blogs->get_post();
?>
<?php include "layout/admin-header.php"; ?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4 mb-5"><?php echo isset($_GET['post']) ? "Update" : "Add"; ?> Blog Post</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="card mb-4">
                <div class="card-header container-fluid">
                    <div class="row">
                        <div class="col-md-12 float-right">
                            <input type="submit" class="btn btn-primary float-right" value="<?php echo isset($_GET['post']) ? "Update" : "Add"; ?> Post">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="_token" value="fvJzbUW9YNK9vwcKSEhcZSflToOiST6uivFpTTiz">
                    <div class="row">
                        <div class="col-sm-12 col-md-10">
                            <div class="form-group">
                                <label for="blog_title">Blog Post Title</label>
                                <input type="text" class="form-control" required="" id="blog_title" aria-describedby="blog_title_help" name="title" value="<?php echo $blog->title; ?>">
                                <small id="blog_title_help" class="form-text text-muted">The title of the blog post</small>
                            </div>

                            <div class="form-group">
                                <label for="blog_subtitle">Subtitle</label>
                                <input type="text" class="form-control" id="blog_subtitle" aria-describedby="blog_subtitle_help" name="subtitle" value="<?php echo $blog->subtitle; ?>">
                                <small id="blog_subtitle_help" class="form-text text-muted">The subtitle of the blog post (optional)</small>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="blog_slug">Blog Post Slug</label>
                                        <input type="text" class="form-control" id="blog_slug" aria-describedby="blog_slug_help" name="slug" value="<?php echo $blog->slug; ?>">
                                        <small id="blog_slug_help" class="form-text text-muted">The slug (leave blank to auto generate)</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="blog_is_published">Published?</label>

                                        <select name="is_published" class="form-control" id="blog_is_published" aria-describedby="blog_is_published_help">
                                            <option value="1" <?php echo $blog->is_published == 1 ? 'selected' : ''; ?>>
                                                Published
                                            </option>
                                            <option value="0" <?php echo $blog->is_published == 0 ? 'selected' : ''; ?>>Not
                                                Published
                                            </option>

                                        </select>
                                        <small id="blog_is_published_help" class="form-text text-muted">Should this be published? If not, then it
                                            won't be
                                            publicly viewable.
                                        </small>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="blog_posted_at">Posted at</label>
                                        <input type="text" class="form-control" id="blog_posted_at" aria-describedby="blog_posted_at_help" name="startdate" value="<?php echo $blog->startdate; ?>">
                                        <small id="blog_posted_at_help" class="form-text text-muted">When this should be published. If this value is
                                            greater
                                            than now (2020-07-05 13:10:41) then it will not (yet) appear on your blog. Should be in the <code>YYYY-MM-DD
                                                HH:MM:SS</code> format.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div class="bg-white pt-4 px-4 pb-0 my-2 mb-4 rounded border float-right">
                                <h4>Categories:</h4>
                                <div class="row">
                                    <div class="form-check col-sm-6">
                                        <input class="" type="checkbox" value="1" name="category[1]" id="category_check1">
                                        <label class="form-check-label" for="category_check1">
                                            Lifestyle
                                        </label>
                                    </div>

                                    <div class="col-md-12 my-3 text-center">
                                        <em><a target="_blank" href="http://thetopcoins.test/admin/categories/add_category"><i class="fa fa-external-link" aria-hidden="true"></i>
                                                Add new categories
                                                here</a></em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" data-children-count="1">
                        <label for="blog_post_body">Post Body
                            (HTML)
                        </label>
                        <textarea class="form-control" id="detail" aria-describedby="blog_post_body_help" name="detail"><?php echo $blog->detail; ?></textarea>
                        <div class="alert alert-danger">
                            Please note that any HTML (including any JS code) that is entered here will be
                            echoed (without escaping)
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="blog_seo_title">SEO: &lt;title&gt; tag (optional)</label>
                        <input class="form-control" id="blog_seo_title" aria-describedby="blog_seo_title_help" name="seo_title" tyoe="text" value="<?php echo $blog->seo_title; ?>">
                        <small id="blog_seo_title_help" class="form-text text-muted">Enter a value for the &lt;title&gt; tag. If nothing is
                            provided here we will just use the normal post title from above (optional)</small>
                    </div>

                    <div class="form-group">
                        <label for="blog_meta_desc">Meta Desc (optional)</label>
                        <textarea class="form-control" id="blog_meta_desc" aria-describedby="blog_meta_desc_help" name="meta_desc"><?php echo $blog->meta_desc; ?></textarea>
                        <small id="blog_meta_desc_help" class="form-text text-muted">Meta description (optional)</small>
                    </div>

                    <div class="form-group">
                        <label for="blog_short_description">Short Desc (optional)</label>
                        <textarea class="form-control" id="blog_short_description" aria-describedby="blog_short_description_help" name="short_description"><?php echo $blog->short_description; ?></textarea>
                        <small id="blog_short_description_help" class="form-text text-muted">Short description (optional - only useful if
                            you use in your template views)</small>
                    </div>


                    <div class="bg-white pt-4 px-4 pb-0 my-2 mb-4 rounded border">
                        </style>
                        <h4>Featured Image</h4>
                        <div class="form-group mb-4 p-2">
                            <label for="blog_image_large">Image</label>
                            <small id="blog_image_large_help" class="form-text text-muted">Upload image</small>
                            <input style="height: auto" class="form-control" type="file" name="image_large" id="image_upload" aria-describedby="blog_image_large_help">
                        </div>
                    </div>

                </div>                
                <div class="card-footer text-muted">
                    <div class="row">
                        <div class="col-md-12 float-right">
                            <input  type="submit" class="btn btn-primary float-right" value="<?php echo isset($_GET['post']) ? "Update" : "Add"; ?> Post">
                        </div>
                    </div>
                </div>
            </div><!-- end .card -->
        </form>
    </div>
</main>
<?php include "layout/admin-footer.php"; ?>