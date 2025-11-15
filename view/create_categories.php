<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add categories</title>

    <h2>Create Category</h2>
    <br><br>
</head>
<body>
    <form action="../controller/create_categories.php" method="post">
        <label for="category_name">Category Name:</label>
        <input type="text" name="category_name" required>
        <input type="submit" value="add category">
    </form>
</body>
</html>