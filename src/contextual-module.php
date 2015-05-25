<aside class="contextual-module">
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
  else:
    get_sidebar();
  endif;
  ?>
</aside>

