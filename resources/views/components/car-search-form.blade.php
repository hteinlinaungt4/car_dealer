<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <div>
                    <label for="brand">Brand:</label>
                    <select name="brand" id="brand">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="model">Model:</label>
                    <select name="model" id="model">
                        <option value="">Select Model</option>
                        @foreach($models as $model)
                            <option value="{{ $model }}">{{ $model }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="color">Color:</label>
                    <select name="color" id="color">
                        <option value="">Select Color</option>
                        @foreach($colors as $color)
                            <option value="{{ $color }}">{{ $color }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="min_price">Min Price:</label>
                    <input type="number" name="min_price" id="min_price">
                </div>

                <div>
                    <label for="max_price">Max Price:</label>
                    <input type="number" name="max_price" id="max_price">
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#brand, #model, #color, #min_price, #max_price').on('change', function() {
                        var brand = $('#brand').val();
                        var model = $('#model').val();
                        var color = $('#color').val();
                        var min_price = $('#min_price').val();
                        var max_price = $('#max_price').val();

                        $.ajax({
                            url: "{{ route('cars.search') }}",
                            type: 'GET',
                            data: {
                                brand: brand,
                                model: model,
                                color: color,
                                min_price: min_price,
                                max_price: max_price,
                            },
                            success: function(response) {
                                $('#car-results').html(response);
                            }
                        });
                    });
                });
            </script>

        </div>
    </div>
</div>
