{?if $result_list ?}

<table>
{? if !$ref ?}
<caption>竞赛编号:[{?$contest_id?}],用户ID:[{?$user_id?}]</caption>
{? /if ?}
<tr>
	 <th class="span-5 top_left_radius">试题编号</th>
	 <th class="span-5">状态</th>
	 <th class="span-5 top_right_radius">惩罚值</th>
</tr>

{?foreach item=row key=key from=$result_list?}

<tr>
	 {?foreach item=value key=key from=$row?}

	 {?if $value ==  '' ?}
	 	 <td>-</td>
	 	 {?php?}continue;{?/php?}
	 {?/if?}
	 <td>{?$value?}</td>
	 
	 {?/foreach?}
</tr>

{?/foreach?}

</table>
{?/if?}

