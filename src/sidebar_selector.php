<!-- sidebar -->
<aside class="sidebar" role="complementary">
<?php 
  switch {
  case is_post_type_archive("projects"):
      get_sidebar("projects");
    break;
    case is_post_type_archive("tropers"):
      get_sidebar("tropers");
    break;
    case is_post_type_archive("posts"):
      get_sidebar("blog");
    break;
    case is_singular("projects"):
      get_sidebar("project");
    break;
    case is_singular("tropers"):
      get_sidebar("troper");
    break;
    case is_singular("posts"):
      get_sidebar("blogpost");
    break;
  } ?>
</aside>
<!-- /sidebar -->
