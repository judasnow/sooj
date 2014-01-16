{?* 显示新的评测结果 *?}
{?foreach item=row from=$new_result_list?}

<tr>	
	 {?foreach item=value from=$row?}	 
	 <td>
	 	 {?$value?}
	 </td>
	 {?/foreach?}
</tr>

{?/foreach?}
