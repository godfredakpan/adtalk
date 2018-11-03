<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Video extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function toArray($request)
     {
         // return parent::toArray($request);
         return [
             'video_id' => $this->video_id,
             'file_name' => $this->file_name,
             'survey_description' => $this->survey_description
         ];
     }
     public function with($request) {
         return [
             'version' => '1.0.0',
             'author_url' => url('http://traversymedia.com')
         ];
     }
 }