{include file="header.tpl"}
<h1>Seznam uživatelů</h1>
<table>
    <thead>
	<tr>
	    <th>
		#
	    </th>
	    <th>
		Uživatelské jméno
	    </th>
	    <th>
		E-mail
	    </th>
	</tr>
    </thead>
    <tbody>
	{foreach from=$users item=user}
	<tr>
	    <td>
		{$user->id}
	    </td>
	    <td>
		{$user->username}
	    </td>
	    <td>
		{$user->email}
	    </td>
	</tr>
	{/foreach}
    </tbody>
</table>

{include file="footer.tpl"}