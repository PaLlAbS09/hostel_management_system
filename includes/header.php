<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hostel Management System - Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN for Logout and Dropdown Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">

    <style>
        body {
            background-color: #f4f6f9;
            margin: 0;
            overflow-x: hidden;
        }

        /* Topbar & Navbar */
        .topbar {
            position: fixed;
            width: 100%;
            height: 64px;
            background: #fff;
            z-index: 50;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        .topbar .navbar {
            padding: 0;
            height: 100%;
        }

        .navbar-header {
            width: 250px;
            text-align: center;
            background: #fff;
            flex-shrink: 0;
        }

        ul.navbar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        /* Left Sidebar */
        .left-sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            top: 64px;
            background: #fff;
            z-index: 20;
            box-shadow: 1px 0 5px rgba(0, 0, 0, 0.05);
            padding-top: 15px;
        }

        #sidebarnav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #sidebarnav .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #5f6368;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        #sidebarnav .sidebar-link:hover {
            background: #f0f2f5;
            color: #000;
        }

        #sidebarnav .sidebar-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .nav-small-cap {
            font-size: 12px;
            font-weight: 700;
            color: #a1aab2;
            padding: 12px 20px;
            text-transform: uppercase;
        }

        .list-divider {
            border-top: 1px solid #eef1f3;
            margin: 10px 0;
        }

        /* Page Content */
        .page-wrapper {
            margin-left: 250px;
            padding-top: 84px;
            padding-left: 20px;
            padding-right: 20px;
            min-height: 100vh;
        }

        /* Dropdown & Logout Design */


        .dropdown-toggle::after {
            display: none !important;
        }

        .dropdown-menu {
            border: none;
            border-radius: 12px;
            padding: 10px 0;
            min-width: 200px;
            margin-top: 10px !important;
        }

        .logout-btn {
            background-color: #fff0f0;
            color: #e63946 !important;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 15px;

            width: auto;
            margin: 5px 10px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #e63946;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);
            transform: translateY(-1px);
        }

        .logout-btn i {
            font-size: 1.2rem;
        }

        .scroll-sidebar {
            height: calc(100vh - 64px);
            overflow-y: auto;
            overflow-x: hidden;
            padding-bottom: 60px;
        }

        .scroll-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .scroll-sidebar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .scroll-sidebar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
</head>