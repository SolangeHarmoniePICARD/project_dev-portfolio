<?php include 'include_header.php' ?>

<form action="handler_project-add.php" method="post">
    <div>
        <label for="input_title">Title: </label>
        <input type="text" id="input_title" name="data_title">
    </div>
    <div>
        <label for="input_description">Description: </label>
        <textarea id="input_description" rows="8" name="data_description"></textarea>
    </div>
    <div >
        <input type="submit" id="form_submit" value="Add Project">
        <input type="reset" value="Reset">
    </div>
</form>


<?php include 'include_footer.php' ?>