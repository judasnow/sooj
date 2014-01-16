{?*显示不同级别的提示表单信息*?}
{?*判断存放错误信息的数组是否存在且不为空*?}

{?if $form_message|@is_array?}
	{? assign var=has_message value=true?}
{?else?}
	{? assign var=has_message value=false?}
{?/if?}
{?if $has_message?}
{?foreach key=key item=item from=$form_message?}
	 {?assign var=$key value=$item?}
{?/foreach?}

<div class="{?$type?}"> 
 	 {?$content?}
</div>

{?/if?}
