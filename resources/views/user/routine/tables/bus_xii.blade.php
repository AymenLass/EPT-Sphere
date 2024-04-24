<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>Day \ Time</th>
                <th>10:30</th>
                <th>11:15</th>
                <th>12:00</th>
                <th>12:45</th>
                <th>01:30</th>
            </tr>
        </thead>
        <tbody id="table_body">

            @foreach ($xii_routine as $item)
                <tr>
                    <th class="text-center">{{ $item->day }}</th>
                    <td>{{ $item->bus10_30 }}</td>
                    <td>{{ $item->bus11_15 }}</td>
                    <td>{{ $item->bus12_00 }}</td>
                    <td>{{ $item->bus12_45 }}</td>
                    <td>{{ $item->bus1_30 }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        <a href="{{ route('routines.export', ['class' => 'SecondY', 'dept' => 'bus']) }}" class="btn btn-success"
            target="blank"><i class="fas fa-file-export"></i> Export</a>
    </div>
</div>
