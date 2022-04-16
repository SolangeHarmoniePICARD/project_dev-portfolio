<?php include 'include_header.php'; ?>
<form action="handler_project-add.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="input_title">Title: </label>
        <input type="text" id="input_title" name="data_title" required>
    </div>
    <div>
        <label for="input_thumbnail">Thumbnail: </label>
        <input type="file" id="input_thumbnail" name="data_thumbnail" required>
    </div>
    <div>
        <label for="input_description">Description: </label>
        <textarea id="input_description" rows="8" name="data_description" required></textarea>
    </div>
    <div >
        <input type="hidden" value='0' name="data_status" id="input_status">
        <input type="submit" value="Add Project" name="data_submit"  id="input_submit">
        <input type="reset" value="Reset">
    </div>
</form>
<div>
    <a href="view_back-home.php">
        <button>Back</button>
    </a>
</div>
<?php include 'include_footer.php'; ?>