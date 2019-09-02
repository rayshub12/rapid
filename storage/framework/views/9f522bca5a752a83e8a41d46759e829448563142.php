<html>
    <head>
        <title>A User Send an Enquiry about Property [<?php echo e($prop_name); ?>]</title>
    </head>
    <body>
        <p>Hi Rapid Deals,</p>
        <table>
            <tr><td>Name</td><td><?php echo e($name); ?></td></tr>
            <tr><td>Email</td><td><?php echo e($email); ?></td></tr>
            <tr><td>Phone</td><td><?php echo e($phone); ?></td></tr>
            <tr><td>Property</td><td><?php echo e($prop_name); ?></td></tr>
            <tr><td>Link</td><td><?php echo e($prop_url); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Message</td><td><?php echo e($enquiry_message); ?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Thanks & Regards,</td></tr>
            <tr><td><?php echo e($name); ?></td></tr>
        </table>
    </body>
</html><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/emails/enquiry.blade.php ENDPATH**/ ?>