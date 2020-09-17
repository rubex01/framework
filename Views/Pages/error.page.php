<div class="error-container">
    <div>

        <div class="table-error-title">
            <h1><?php echo $data['code']; ?></h1>
            <h4><?php echo $data['message']; ?></h4>
        </div>

        <hr class="error-hr">

        <table>

            <tr>
                <th>File</th>
                <th>Line</th>
                <th>Function</th>
                <th>Type</th>
                <th>Arguments</th>
            </tr>

            <?php foreach ($data['trace'] as $trace) { ?>
                <tr class="error-list">
                    <td>
                        <span class="error-file"><?php print_r($trace['file']); ?></span>
                    </td>
                    <td>
                        <span class="error-line"><?php print_r($trace['line']); ?></span>
                    </td>
                    <td>
                        <span class="error-function"><?php print_r($trace['function']); ?>()</span>
                    </td>
                    <td>
                        <span class="error-type"><?php print_r($trace['type']); ?></span>
                    </td>
                    <td>
                        <span class="error-args"><?php print_r($trace['args']); ?></span>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>