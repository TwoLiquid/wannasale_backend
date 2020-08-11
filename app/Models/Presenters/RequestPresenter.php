<?php

namespace App\Models\Presenters;

trait RequestPresenter
{
    public function getPrettyStatusAttribute() : string
    {
        return trans('models/request.status.' . $this->status);
    }

    public function getCustomFieldsAttribute() : ?array
    {
        $customFields = [];

        if ($this->attributes['custom_fields'] == null) {
            return null;
        }

        foreach (json_decode($this->attributes['custom_fields']) as $customField) {
            $customFields[] = [
                'title' => $customField->title,
                'value' => $customField->value
            ];
        }

        return $customFields;
    }
}
