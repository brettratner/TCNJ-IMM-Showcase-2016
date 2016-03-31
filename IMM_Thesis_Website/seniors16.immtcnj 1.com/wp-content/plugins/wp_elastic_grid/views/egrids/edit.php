<div class="wrap">
  <h2 id="add-new-user"> Update</h2>

  <?php
  // echo '<pre>';
  // print_r($data);
  // echo '</pre>';
  ?>
  <div id="ajax-response"></div>

  <form method="post" name="createquiz" id="createuser" class="validate" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input name="action" type="hidden" value="createquiz">
    <input name="data[id]" type="hidden" id="id" value="<?php echo $data['id'];?>" aria-required="true">
    <table class="form-table">
      <tbody>
        <tr class="form-field form-required">
          <th scope="row"><label for="title">Title <span class="description">(required)</span></label></th>
          <td><input name="data[title]" type="text" id="title" value="<?php echo $data['title'];?>" aria-required="true"></td>
        </tr>
        <tr class="form-field">
          <td><h3>Effect Options</h3></td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Filter Effect</label></th>
          <td>
            <select name="data[filter_effect]" id="filter_effect">
              <option <?php if($data['filter_effect']=='moveup') echo 'selected="selected"';?> value="moveup">Move Up</option>
              <option <?php if($data['filter_effect']=='scaleup') echo 'selected="selected"';?> value="scaleup">Scale Up</option>
              <option <?php if($data['filter_effect']=='fallperspective') echo 'selected="selected"';?> value="fallperspective">Fall Perspective</option>
              <option <?php if($data['filter_effect']=='fly') echo 'selected="selected"';?> value="fly">Fly</option>
              <option <?php if($data['filter_effect']=='flip') echo 'selected="selected"';?> value="flip">Flip</option>
              <option <?php if($data['filter_effect']=='helix') echo 'selected="selected"';?> value="helix">Helix</option>
              <option <?php if($data['filter_effect']=='popup') echo 'selected="selected"';?> value="popup">Popup</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Hover Direction</label></th>
          <td>
            <select name="data[hover_direction]" id="published">
              <option <?php if($data['hover_direction']=='0') echo 'selected="selected"';?> value="0">No</option>
              <option <?php if($data['hover_direction']=='1') echo 'selected="selected"';?> value="1">Yes</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Hover Inverse</label></th>
          <td>
            <select name="data[hover_inverse]" id="published">
              <option <?php if($data['hover_inverse']=='0') echo 'selected="selected"';?> value="0">No</option>
              <option <?php if($data['hover_inverse']=='1') echo 'selected="selected"';?> value="1">Yes</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Hover Delay</label></th>
          <td><input name="data[hover_delay]" type="number" id="hover_delay" value="<?php echo $data['hover_delay'];?>" aria-required="true"> ms</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Expanding Speed</label></th>
          <td><input name="data[expanding_speed]" type="number" id="expanding_speed" value="<?php echo $data['expanding_speed'];?>" aria-required="true"> ms</td>
        </tr>
        <tr class="form-field">
          <td><h3>Image Options</h3></td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Thumbnail Image Width</label></th>
          <td><input name="data[thumb_width]" type="number" id="thumb_width" value="<?php echo $data['thumb_width'];?>" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Thumbnail Image Height</label></th>
          <td><input name="data[thumb_height]" type="number" id="thumb_height" value="<?php echo $data['thumb_height'];?>" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Thumbnail Image Resize Options</label></th>
          <td>
            <select name="data[thumb_type]" id="thumb_type">
              <option <?php if($data['thumb_type']=='auto') echo 'selected="selected"';?> value="auto">Auto</option>
              <option <?php if($data['thumb_type']=='exact') echo 'selected="selected"';?> value="exact">Exact</option>
              <option <?php if($data['thumb_type']=='portrait') echo 'selected="selected"';?> value="portrait">Portrait</option>
              <option <?php if($data['thumb_type']=='landscape') echo 'selected="selected"';?> value="landscape">Landscape</option>
              <option <?php if($data['thumb_type']=='crop') echo 'selected="selected"';?> value="crop">Crop</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Full Image Width</label></th>
          <td><input name="data[resize_width]" type="number" id="resize_width" value="<?php echo $data['resize_width'];?>" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Full Image Height</label></th>
          <td><input name="data[resize_height]" type="number" id="resize_height" value="<?php echo $data['resize_height'];?>" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Full Image Resize Options</label></th>
          <td>
            <select name="data[resize_type]" id="resize_type">
              <option <?php if($data['resize_type']=='auto') echo 'selected="selected"';?> value="auto">Auto</option>
              <option <?php if($data['resize_type']=='exact') echo 'selected="selected"';?> value="exact">Exact</option>
              <option <?php if($data['resize_type']=='portrait') echo 'selected="selected"';?> value="portrait">Portrait</option>
              <option <?php if($data['resize_type']=='landscape') echo 'selected="selected"';?> value="landscape">Landscape</option>
              <option <?php if($data['resize_type']=='crop') echo 'selected="selected"';?> value="crop">Crop</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>

    <p class="submit">
      <input type="submit" name="createquiz" id="createquizsub" class="button button-primary" value="Update">
      <a href="admin.php?page=elastic-grid" class="button">Cancel</a>
    </p>
  </form>
</div>