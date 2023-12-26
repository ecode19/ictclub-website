<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources Repository | MICs</title>
    @include('links')
</head>

<body>
    @include('admin.adminNav')
    <main>
        @include('admin.message')
        <div class="container">
            <form action="resources_upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="resource_name">Resource Name:</label>
                    <input type="text" class="form-control" id="resource_name" name="resource_name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category">
                        <option value="presentation">Presentation</option>
                        <option value="document">Document</option>
                        <option value="tutorial">Tutorial</option>
                        <!-- Add more categories here -->
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="file">Upload File:</label>
                    <input type="file" class="form-control-file" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload Resource</button>
            </form>
        </div>
    </main>
</body>

</html>
