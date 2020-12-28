<style>
    /* Table details CSS*/
    table.table-references {
        width: 100%;
        border-collapse: collapse;
        transform: translate(0, -16px);
        margin-top: 16px;
    }
    table.table-references thead tr:nth-child(1) {
        background-color: #0074D9;
        color: white;
    }
    table.table-references thead tr:nth-child(2) {
        background-color: #DDDDDD;
        color: #1e3799;
    }
    table.table-references th, table.table-references td {
        border: 1px dashed #0074D9;
        padding: 0px 6px 0px 6px; /* top, right, bottom, left */
        font-size: 12px;
    }
</style>

<table class='table-references'>
    <thead>
        <tr><th colspan='6'>REFERENCIAS</th></tr>
    </thead>
    <tbody>
        <tr>
            @if ( count($references) === 0 )
                <td colspan='6' valign='top'><strong>Sol. Abastecimiento: </strong>Sin referencias.</td>
            @else
                <td colspan='6' valign='top'><strong>Sol. Abastecimiento: </strong>N° {{ collect($references)->implode(', N°') }}</td>
            @endif
        </tr>
    </tbody>
</table>
