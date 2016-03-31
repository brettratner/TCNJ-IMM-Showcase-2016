<?php
wp_register_script('json2', WP_EGRIDS_PLUGIN_URL.'/assets/js/json2.js', array('jquery'), '1.0', true);
wp_enqueue_script('json2');
wp_register_script('jquerytabledndjs', WP_EGRIDS_PLUGIN_URL.'/assets/js/jquery.tablednd.js', array('jquery'), '1.0', true);
wp_enqueue_script('jquerytabledndjs');
wp_register_script('backendjs', WP_EGRIDS_PLUGIN_URL.'/assets/js/backend.js', array('jquery', 'jquerytabledndjs', 'json2'), '1.0', true);
wp_localize_script('backendjs', 'tablednd',array('blogURL' => get_bloginfo("url")));
wp_enqueue_script('backendjs');
?>
<div class="wrap">
    <div id="icon-page" class="icon32"><br/></div>
    <h2>
        <?php echo $data['title'];?>
        <a href="?page=<?php echo $_REQUEST['page']?>&controller=projects&action=add&egrid_id=<?php echo $_GET['egrid_id']?>" class="add-new-h2">Add New</a>
        <a href="?page=<?php echo $_REQUEST['page']?>" class="add-new-h2">Back</a>
    </h2>
     <?php if(isset($_SESSION['egrids_flash'])) echo $_SESSION['egrids_flash']; ?>

    <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <!-- Now we can render the completed list table -->
	     <?php $wp_list_table->display(); ?>
	</form>
</div>
<script type="text/javascript">
    function selectText(containerid) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().addRange(range);
        }
    }
</script>
<?php
// remove flash message
if(isset($_SESSION['egrids_flash'])){ unset($_SESSION['egrids_flash']); }
?>