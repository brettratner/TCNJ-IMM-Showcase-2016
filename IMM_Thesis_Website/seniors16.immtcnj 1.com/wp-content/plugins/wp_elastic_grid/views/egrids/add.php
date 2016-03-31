<div class="wrap">
  <h2 id="add-new-user"> Add New</h2>

  <div id="ajax-response"></div>

  <form method="post" name="createquiz" id="createuser" class="validate" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input name="action" type="hidden" value="createquiz">
    <table class="form-table">
      <tbody>
        <tr class="form-field form-required">
          <th scope="row"><label for="title">Title <span class="description">(required)</span></label></th>
          <td><input name="data[title]" type="text" id="title" value="<?php //echo $data['title'];?>" aria-required="true"></td>
        </tr>
        <tr class="form-field">
          <td><h3>Effect Options</h3></td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Filter Effect</label></th>
          <td>
            <select name="data[filter_effect]" id="filter_effect">
              <option value="moveup">Move Up</option>
              <option value="scaleup">Scale Up</option>
              <option value="fallperspective">Fall Perspective</option>
              <option value="fly">Fly</option>
              <option value="flip">Flip</option>
              <option value="helix">Helix</option>
              <option value="popup">Popup</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Hover Direction</label></th>
          <td>
            <select name="data[hover_direction]" id="published">
              <option value="0">No</option>
              <option selected="selected" value="1">Yes</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Hover Inverse</label></th>
          <td>
            <select name="data[hover_inverse]" id="published">
              <option value="0">No</option>
              <option value="1">Yes</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Hover Delay</label></th>
          <td><input name="data[hover_delay]" type="number" id="hover_delay" value="0" aria-required="true"> ms</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Expanding Speed</label></th>
          <td><input name="data[expanding_speed]" type="number" id="expanding_speed" value="500" aria-required="true"> ms</td>
        </tr>
        <tr class="form-field">
          <td><h3>Image Options</h3></td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Thumbnail Image Width</label></th>
          <td><input name="data[thumb_width]" type="number" id="thumb_width" value="200" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Thumbnail Image Height</label></th>
          <td><input name="data[thumb_height]" type="number" id="thumb_height" value="200" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Thumbnail Image Resize Options</label></th>
          <td>
            <select name="data[thumb_type]" id="thumb_type">
              <option value="auto">Auto</option>
              <option value="exact">Exact</option>
              <option value="portrait">Portrait</option>
              <option value="landscape">Landscape</option>
              <option value="crop">Crop</option>
            </select>
          </td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Full Image Width</label></th>
          <td><input name="data[resize_width]" type="number" id="resize_width" value="500" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Full Image Height</label></th>
          <td><input name="data[resize_height]" type="number" id="resize_height" value="500" aria-required="true"> px</td>
        </tr>
        <tr class="form-field">
          <th scope="row"><label for="role">Full Image Resize Options</label></th>
          <td>
            <select name="data[resize_type]" id="resize_type">
              <option value="auto">Auto</option>
              <option value="exact">Exact</option>
              <option value="portrait">Portrait</option>
              <option value="landscape">Landscape</option>
              <option value="crop">Crop</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>

    <p class="submit">
      <input type="submit" name="createquiz" id="createquizsub" class="button button-primary" value="Add New">
      <a href="admin.php?page=elastic-grid" class="button">Cancel</a>
    </p>
  </form>
</div>