<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <!-- Add Iconify script here -->
</head>
<body style="background-color: #f3f4f6; margin: 0;">

    <!-- Include the sidebar once -->
    @include('admin.partials.sidebar')

    <!-- Push the main content to the right of the 260px sidebar -->
    <main style="margin-left: 260px; padding: 40px;">
        @yield('content')
        
    </main>

</body>
</html>

Now, anytime you need to add a new link to the sidebar, you only have to edit the `sidebar.blade.php` file and it will instantly update across your entire admin panel!