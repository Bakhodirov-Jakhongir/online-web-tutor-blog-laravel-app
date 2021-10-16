<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel 8 Dynamic Dependent Dropdown using jQuery Ajax</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div class="container">
        <h3>Laravel 8 Dynamic Dependent Dropdown using jQuery Ajax</h3>
        <div class="panel panel-primary">
            <div class="panel-heading">Laravel 8 Dynamic Dependent Dropdown using jQuery Ajax</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select id="country" name="country" class="form-control">
                        <option value="" selected disabled>Select Country</option>
                        @foreach ($countries as $key => $country)
                            <option value="{{ $key }}"> {{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="state">State:</label>
                    <select name="state" id="state" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
    <script>
        // when country dropdown changes
        $('#country').change(function() {

            var countryID = $(this).val();

            if (countryID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getState') }}?country_id=" + countryID,
                    success: function(res) {

                        if (res) {

                            $("#state").empty();
                            $("#state").append('<option>Select State</option>');
                            $.each(res, function(key, value) {
                                $("#state").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#state").empty();
                        }
                    }
                });
            } else {

                $("#state").empty();
                $("#city").empty();
            }
        });

        // when state dropdown changes
        $('#state').on('change', function() {

            var stateID = $(this).val();

            if (stateID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getCity') }}?state_id=" + stateID,
                    success: function(res) {

                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>Select City</option>');
                            $.each(res, function(key, value) {
                                $("#city").append('<option value="' + key + '">' + value +
                                    '</option>');
                            });

                        } else {

                            $("#city").empty();
                        }
                    }
                });
            } else {

                $("#city").empty();
            }
        });

    </script>
</body>

</html>