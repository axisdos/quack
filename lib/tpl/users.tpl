{extends "../../lib/tpl/admindash.tpl"}
{block "dashboard"}
    <h1>Users</h1>
    <hr />
    
    <table class="table table-striped">
        <th>Username</th>
        <th>Registration Date</th>
        {foreach $users as $usera}
        <tr>
            <td>{$usera['username']}</td>
            <td>{$usera['date']}</td>
        </tr>
        {/foreach}
    </table>
{/block}