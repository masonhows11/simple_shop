@inject('price','App\Services\Price\Contracts\PriceInterface')
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th, td {
        text-align: right;
        padding: 8px;
    }
    body {
        font-family:  sans-serif;
    }

    tr:nth-child(even){background-color: #f2f2f2}
</style>
<body>


<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>نام محصول</th>
            <th>قیمت</th>
            <th>تعداد</th>
            <th>مجموع</th>
        </tr>
        <tr>
            <td>محصول شماره یک</td>
            <td>10000</td>
            <td>12</td>
            <td>120000</td>
        </tr>
        <tr>
            <td>محصول شماره دو</td>
            <td>5000</td>
            <td>2</td>
            <td>10000</td>
        </tr>
        <tr>
            <td>محصول شماره سه</td>
            <td>6000</td>
            <td>3</td>
            <td>18000</td>
        </tr>
    </table>
</div>
</body>
</html>

