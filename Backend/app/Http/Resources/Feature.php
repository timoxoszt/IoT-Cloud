<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;

class Feature extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $author = DB::table('users')->where('id', $this->user_id)->first();
        if(is_null($author)){
            $author_name = "Author is not exist.";
        }else{
            $author_name = $author->name;
        };

        return [
            'uuid' => $this->uuid,
            'device' => $this->device,
            'value' => $this->value,
            'type' => $this->type,
            'note' => $this->note,
            'author' => $author_name,
        ];
    }
}
