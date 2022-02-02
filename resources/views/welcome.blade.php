<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        #app {
            margin: auto;
            width: 75%;
            overflow: hidden;
        }

        .d-flex {
            padding: 10px;
            margin: 10px;
            display: flex;
            align-items: center;
            height: 100%;
            flex-direction: column;
        }

        #jstree,
        #result {
            width: 60%;
            padding: 10px;
            margin: 10px;
            background-color: azure;
            border: 1px solid #000;
            border-radius: 25px;
        }

        #result h3 span {
            font-size: 25px;
            font-weight: 100;
        }

    </style>
</head>

<body id="app">
    <div class="d-flex">

        <div id="result">
            <h3>Route: <span>Click On Model</span></h3>
            <h5>Data: <span>None</span></h3>
        </div>

        <div id="jstree">

            <ul>
                <li data-jstree='{"opened":true}' data-route="{{ route('api.login') }}" data-method="GET">User
                    <ul>
                        <li data-route="None" data-method="None">Not Auth
                            <ul>
                                <li data-route="{{ route('api.register') }}" data-method="POST"
                                    data-form="{'email':'test@test.com','password':'123456','name':'test'}">Register
                                </li>
                                <li data-route="{{ route('api.login') }}" data-method="POST"
                                    data-form="{'email':'test@test.com','password':'123456','name':'test'}">Login</li>
                            </ul>
                        </li>
                        <li data-route="None" data-method="None">Auth
                            <ul>
                                <li data-route="{{ route('api.me') }}" data-method="GET"
                                    data-form="Set Token in Header">Me</li>
                                <li data-route="{{ route('api.logout') }}" data-method="Post"
                                    data-form="Set Token in Header">Logout</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li data-jstree='{"opened":true}' data-route="None" data-method="None">Models
                    <ul>
                        <li data-route="{{ asset('api/v1/category') }}" data-method="GET">Category
                            <ul>
                                <li data-route="{{ asset('api/v1/category') }}" data-method="GET">Get All</li>
                                <li data-route="{{ asset('api/v1/category/1') }}" data-method="GET">Show
                                </li>
                                <li data-route="{{ asset('api/v1/category') }}" data-method="POST"
                                    data-form="{'name':'test insert'}">
                                    Create</li>
                                <li data-route="{{ asset('api/v1/category/1') }}" data-method="PUT"
                                    data-form="{'name':'test update'}">
                                    Update</li>
                                <li data-route="{{ asset('api/v1/category/1') }}" data-method="DELETE">Delete</li>
                            </ul>
                        </li>
                        <li data-route="{{ asset('api/v1/tag') }}" data-method="GET">Tag
                            <ul>
                                <li data-route="{{ asset('api/v1/tag') }}" data-method="GET">Get All</li>
                                <li data-route="{{ asset('api/v1/tag/1') }}" data-method="GET">Show
                                </li>
                                <li data-route="{{ asset('api/v1/tag') }}" data-method="POST"
                                    data-form="{'name':'test insert'}">
                                    Create</li>
                                <li data-route="{{ asset('api/v1/tag/1') }}" data-method="PUT"
                                    data-form="{'name':'test update'}">
                                    Update</li>
                                <li data-route="{{ asset('api/v1/tag/1') }}" data-method="DELETE">Delete</li>
                            </ul>
                        </li>
                        <li data-route="{{ asset('api/v1/ads') }}" data-method="GET">Ads
                            <ul>
                                <li data-route="{{ asset('api/v1/ads') }}" data-method="GET">Get All</li>
                                <li data-route="{{ asset('api/v1/ads') }}" data-method="GET"
                                    data-form="{'keyword':'test','category_id':1,'tag_id':1}">Filter By
                                    {keyword,
                                    tag_id, category_id}</li>
                                <li data-route="{{ asset('api/v1/ads/1') }}" data-method="GET">Show
                                </li>
                                <li data-route="{{ asset('api/v1/ads') }}" data-method="POST"
                                    data-form="{'type':'free','title':'test insert','category_id':'1','tag_id[]':'1','tag_id[]':'3','description':'Description','advertiser':'1','start_date':'2022-03-01 09:00:00'}">
                                    Create</li>
                                <li data-route="{{ asset('api/v1/ads/1') }}" data-method="PUT"
                                    data-form="{'type':'free','title':'test update','category_id':'1','tag_id[]':'1','tag_id[]':'3','description':'Description','advertiser':'1','start_date':'2022-03-01 09:00:00'}">
                                    Update</li>
                                <li data-route="{{ asset('api/v1/ads/1') }}" data-method="DELETE">Delete</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script>
        $(function() {
            $('#jstree').on("select_node.jstree", function(e, data) {
                let ele = $('#' + data.node.id);
                let route = ele.data('route');
                let method = ele.data('method');
                let form_data = ele.data('form');
                form_data = typeof form_data != 'undefined' ? form_data : 'None';
                $('#result h3 span').html(`{${method}} ${route}`);
                $('#result h5 span').html(`${form_data}`);
            });

            $('#jstree').jstree();
        });
    </script>
</body>

</html>
