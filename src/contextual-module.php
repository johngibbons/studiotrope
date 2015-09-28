<aside class="contextual-module">
<?php if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<p id="breadcrumbs">','</p>');
} ?>
<?php 
  if(is_post_type_archive("troper")):
    get_sidebar("tropers");
  elseif(is_tax("image_tag")):
    get_sidebar("images");
  elseif(is_archive()):
    get_sidebar("projects");
  elseif(is_singular("project")):
    get_sidebar("project");
  elseif(is_singular("troper")):
    get_sidebar("troper");
  elseif(is_singular("post")):
    get_sidebar("blogpost");
  elseif(is_search()):
    get_sidebar("search");
  elseif(is_page_template("template-collective.php") || is_page_template("template-collective-people.php") || is_page_template("template-collective-projects.php")):
    get_sidebar("collective");
  elseif(is_page_template("template-contact.php")):
    get_sidebar("contact");
  else:
    get_sidebar();
  endif;
?>
</aside>

