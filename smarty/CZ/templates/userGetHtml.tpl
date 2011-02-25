{include file="header.tpl"}
<h1>Uživatel {$user->username}</h1>
ID: {$user->id}<br />
E-Mail: {$user->email}
<h2>Role uživatele</h2>
<ul>
    {foreach from=$roles item=role}
    <li>{$role->role_name}</li>
    {/foreach}
</ul>
<h2>Skupiny uživatele</h2>
<ul>
    {foreach from=$groups item=group}
    <li>{$role->group_name}</li>
    {/foreach}
</ul>
{include file="footer.tpl"}