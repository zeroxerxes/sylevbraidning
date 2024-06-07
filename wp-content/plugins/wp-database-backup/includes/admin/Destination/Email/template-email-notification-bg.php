<?php
/**
 * Destination email template.
 *
 * @package wpdbbkp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$unsub_token = get_option('wpdbbkp_unsubscribe_token',false);
if(!$unsub_token){
    $unsub_token = hash("sha256", mt_rand(999,99999999));
    update_option('wpdbbkp_unsubscribe_token',$unsub_token ,false);
}
$message = '<div bgcolor="#e3e3e3" style="font-family:Arial;color:#707070;font-size:12px;background-color:#e3e3e3;margin:0;padding:0px">
<div align="center" style="font-family:Arial;width:600px;background-color:#ffffff;margin:0 auto;padding:0px">
    <div style="font-family:Arial;border-bottom-color:#cccccc;border-bottom-width:1px;border-bottom-style:solid;background-color:#eee;margin:0px;padding:4px">
       <a href="https://backupforwp.com/"><img src="'. esc_url( WPDB_PLUGIN_URL.'/assets/images/wp-database-backup.png') .'" alt="Backup for WP" /></a>
    </div>

    <div align="left" style="font-family:Arial;text-align:left;margin:0px;padding:10px">
        <div>
    Dear <strong style="font-family:Arial;margin:0px;padding:0px">WP Database Backup User</strong>, <br><br>

   Full Website Backup Created Successfully on ' . esc_url($site_url) . '.
    <br><br>
            <h3 style="font-family:Arial;font-size:14px;font-weight:bold;margin:0 0 5px 5px;padding:0px">Details as follow</h3>


            <table width="100%" cellspacing="0" cellpadding="0" style="font-family:Arial;width:100%;border-collapse:collapse;border-spacing:0;margin:0px;padding:0px">
                <tbody><tr style="font-family:Arial;margin:0px;padding:0px">
					<th bgcolor="#007bad" align="center" style="width:30px;font-family:Arial;text-align:center;color:#ffffff;font-size:11px;background-color:#007bad;margin:0px;padding:5px 2px;border:1px solid #007bad">#</th>
                    <th bgcolor="#007bad" align="center" style="width:250px;font-family:Arial;text-align:center;color:#ffffff;font-size:11px;background-color:#007bad;margin:0px;padding:5px 2px;border:1px solid #007bad">File Name</th>
                    <th bgcolor="#007bad" align="center" style="font-family:Arial;text-align:center;color:#ffffff;font-size:11px;background-color:#007bad;margin:0px;padding:5px 2px;border:1px solid #007bad">Size</th>

                </tr>
                    <tr style="font-family:Arial;margin:0px;padding:0px">
					<td style="font-family:Arial;margin:0px;padding:2px 5px;border:1px solid #007bad;text-align:right">1</td>
                    <td style="font-family:Arial;margin:0px;padding:2px 5px;border:1px solid #007bad">' . esc_html($filename) . '</td>
                    <td style="font-family:Arial;margin:0px;padding:2px 5px;border:1px solid #007bad">' . esc_html(WPDBBackupEmail::wp_db_backup_format_bytes( $filesize )) . '</td>

                </tr>

                            </tbody></table><br>
    <br>

    Thank you for using WP Database Backup Plugin.
    <br>
    If you like <b>WP Database Backup</b> please leave us a <a href="http://wordpress.org/support/view/plugin-reviews/wp-database-backup" title="Rating" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://wordpress.org/support/view/plugin-reviews/wp-database-backup&amp;source=gmail&amp;ust=1466360448038000&amp;usg=AFQjCNHxdc3F079wMTbRqbs8hw7tYkR6ww">rating </a>
      on <a href="http://wordpress.org/support/view/plugin-reviews/wp-database-backup" title="Rating" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://wordpress.org/support/view/plugin-reviews/wp-database-backup&amp;source=gmail&amp;ust=1466360448038000&amp;usg=AFQjCNHxdc3F079wMTbRqbs8hw7tYkR6ww">WordPress.org</a>

</div>
    </div>

    <div style="font-family:Arial;border-top-style:solid;border-top-color:#cccccc;border-top-width:1px;color:#707070;font-size:12px;background-color:#efefef;margin:0px;padding:15px">
        <table width="100%" cellspacing="0" cellpadding="0" style="font-family:Arial;color:#707070;font-size:12px;margin:0px;padding:0px">
            <tbody><tr style="font-family:Arial;margin:0px;padding:0px">
                <td width="300" valign="top" align="center" style="font-family:Arial;margin:0px;padding:0px">
                    <h4 style="font-family:Arial;margin:0 0 5px;padding:0px">Contacts</h4>
                    <dl style="font-family:Arial;font-size:16px;font-weight:bold;text-align:left;margin:0px 10px 10px;padding:0px">
                        <dt style="font-family:Arial;font-size:13px;font-weight:bold;margin:0px;padding:0px">
                            Tech Support:
                        </dt>
                        <dd style="font-family:Arial;font-weight:normal;font-size:12px;margin:0 0 0 15px;padding:0px">
                         https://backupforwp.com/support/
                        </dd>
                    </dl>
                </td>
            </tr>
        </tbody></table>
    </div>

    <div style="font-family:Arial;border-top-width:1px;border-top-color:#cccccc;border-top-style:solid;background-color:#eee;margin:0px;padding:10px">
        You\'re receiving this email because you have active Email Notification on your site(' . esc_url($site_url) . ').
		<br>If you don\'t like to receieve a Email Notification then <a href="'.esc_url(admin_url('admin-ajax.php?action=wpdbbkp_email_unsubscribe&unsubscribe_token='.esc_attr($unsub_token))).'">Click Here to unsubcribe</a>.
		<div class="yj6qo"></div><div class="adL">
    </div></div><div class="adL">
</div></div><div class="adL">
</div></div>';
