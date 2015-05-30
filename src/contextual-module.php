<aside class="contextual-module">
<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<p id="breadcrumbs">','</p>');
} ?>
<?php 
  if(is_post_type_archive("project")):
    get_sidebar("projects");
  elseif(is_post_type_archive("troper")):
    get_sidebar("tropers");
  elseif(is_post_type_archive("post")):
    get_sidebar("blog");
  elseif(is_singular("project")):
    get_sidebar("project");
  elseif(is_singular("troper")):
    get_sidebar("troper");
  elseif(is_singular("post")):
    get_sidebar("blogpost");
  elseif(is_search()):
    get_sidebar("search");
  elseif(is_page_template("template-collective.php")):
    get_sidebar("collective");
  else:
    get_sidebar();
  endif;
?>
</aside>

