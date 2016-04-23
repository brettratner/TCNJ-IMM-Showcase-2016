<?php
// echo '<pre>';
// print_r($data);
// echo '</pre>';
$gridConfig = $data[1];
$data       = $data[0];

wp_register_style('uploadifycss', WP_EGRIDS_PLUGIN_URL.'/assets/css/uploadify.css');
wp_enqueue_style('uploadifycss');

wp_register_script('tagsinput', WP_EGRIDS_PLUGIN_URL.'/assets/js/jquery.tagsinput.js', array('jquery'), '1.0', true);
wp_enqueue_script('tagsinput');

wp_register_script('sheepItPlugin', WP_EGRIDS_PLUGIN_URL.'/assets/js/jquery.sheepItPlugin.js', array('jquery'), '1.0', true);
wp_enqueue_script('sheepItPlugin');

wp_register_script('uploadifyjs', WP_EGRIDS_PLUGIN_URL.'/assets/js/jquery.uploadify.js', array('jquery'), '1.0', true);
wp_enqueue_script('uploadifyjs');

wp_register_script('backendjs', WP_EGRIDS_PLUGIN_URL.'/assets/js/backend.js', array('jquery'), '1.0', true);
$timestamp = time();
$uploadFolder = wp_upload_dir();
wp_localize_script('backendjs', 'uploadify',
                        array(
                            'projectId'     => $data['id'],
                            'blogURL'       => get_bloginfo("url"),
                            'pluginPath'    =>  WP_EGRIDS_PLUGIN_URL,
                            'upload_folder' =>  $uploadFolder['basedir'].DIRECTORY_SEPARATOR.'wp_elastic_grid'.DIRECTORY_SEPARATOR,
                            'thumb_width'   =>  $gridConfig['thumb_width'],
                            'thumb_height'  =>  $gridConfig['thumb_height'],
                            'thumb_type'    =>  $gridConfig['thumb_type'],
                            'resize_width'  =>  $gridConfig['resize_width'],
                            'resize_height' =>  $gridConfig['resize_height'],
                            'resize_type'   =>  $gridConfig['resize_type'],
                            'timestamp'     =>  $timestamp,
                            'token'         =>   md5('phapsu.com' . $timestamp)
                        ));
$button_list = (!empty($data['button_list'])) ? $data['button_list'] : json_encode(array());
wp_localize_script('backendjs', 'cloneForm', $button_list);
wp_enqueue_script('backendjs');
?>

<div class="wrap">
    <h2 id="add-new-user"> Edit "<?php echo $data['title'];?>"
        <span>
        <a href="admin.php?page=elastic-grid&controller=projects&action=index&egrid_id=<?php echo $_GET['egrid_id']?>" class="button">Back</a>
        </span>
    </h2>
    <br>
    <div id="ajax-response"></div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li><a href="#informations" data-toggle="tab">Informations</a></li>
        <li class="active"><a href="#upload" data-toggle="tab">Upload</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane" id="informations">
            <form method="post" name="createquiz" id="createuser" class="validate" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                <input name="data[id]" type="hidden" value="<?php echo $data['id'];?>">
                <table class="form-table">
                    <tbody>
                        <tr class="form-field form-required">
                            <th scope="row"><label for="title">Title <span class="description">(required)</span></label></th>
                            <td><input name="data[title]" type="text" id="title" value="<?php echo $data['title'];?>" aria-required="true"></td>
                        </tr>
                        <tr class="form-field form-required">
                            <th scope="row"><label for="description">Description <span class="description"></span></label></th>
                            <td><textarea name="data[description]" id="description" style="width:25em;" rows="5"><?php echo $data['description'];?></textarea></td>
                        </tr>
                        <tr class="form-field">
                            <th scope="row"><label for="tags">Tags <span class="description"></span></label></th>
                            <td><input name="data[tags]" class="tagsinput" type="text" id="tags" value="<?php echo $data['tags'];?>" aria-required="true"></td>
                        </tr>
                        <tr class="form-field form-required">
                            <th scope="row"><label for="tags">Link</label></th>
                            <td>
                                <!-- sheepIt Form -->
                                <div id="sheepItForm">

                                  <!-- Form template-->
                                  <div id="sheepItForm_template" class="sheepItForm_template">
                                    <input id="sheepItForm_#index#_title" placeholder="Title" name="data[button_list][#index#][title]" type="text" size="10"  />
                                    <input id="sheepItForm_#index#_url" placeholder="URL" name="data[button_list][#index#][url]" type="text" size="15"  />
                                    <a id="sheepItForm_remove_current">
                                      <img class="delete" src="<?php echo plugins_url('wp_elastic_grid');?>/assets/img/cross.png" width="16" height="16" border="0">
                                    </a>
                                  </div>
                                  <!-- /Form template-->

                                  <!-- No forms template -->
                                  <div id="sheepItForm_noforms_template">No Link</div>
                                  <!-- /No forms template-->

                                  <!-- Controls -->
                                  <div id="sheepItForm_controls">
                                    <div id="sheepItForm_add"><a><span>Add link</span></a></div>
                                    <div id="sheepItForm_remove_last"><a><span>Remove</span></a></div>
                                    <div id="sheepItForm_remove_all"><a><span>Remove all</span></a></div>
                                  </div>
                                  <!-- /Controls -->

                                </div>
                                <!-- /sheepIt Form -->
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="submit">
                    <input rel="popover" data-content="" type="submit" name="createproject" id="createproject" class="button button-primary" value="Submit"></a>
                    <a href="admin.php?page=elastic-grid&controller=projects&action=index&egrid_id=<?php echo $_GET['egrid_id']?>" class="button">Cancel</a>
                </p>
            </form>
        </div>
        <div class="tab-pane active" id="upload">
            <table class="form-table">
              <tr>
                <td>
                  <div id="project_photos"></div>
                </td>
              </tr>
              <tr>
                <td>
                  <form  style="margin: 40px 0;">
                      <div id="queue"></div>
                      <input id="file_upload" name="file_upload" type="file" multiple="true">
                  </form>
                </td>
              </tr>
            </table>
        </div>
    </div>
</div>