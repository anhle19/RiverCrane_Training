<table>
    <thead>
    <tr>
        <th>Tên khách hàng</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $item)
        <tr>
            <td>{{ $item->customer_name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->tel_num }}</td>
            <td>{{ $item->address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>