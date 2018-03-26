<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name', 'description', 'url', 'extension', 'date_of_document', 'date_of_upload', 'uploaded_by_id', 'is_revised', 'number_of_revisions', 'current_document_id'];
    protected $table = 'documents';

    public function getBoxAttribute()
    {
    	return '<div class="row"><div class="col-12"><div class="card">
    		<div class="card-header">Document uploaded on '.$this->date_created.' by '.$this->uploader_name.'</div>
    		<div class="card-body">'.$this->description_and_document.'</div>
    		<div class="card-footer">Revisions</div>
    		</div></div></div>';
    }

    public function getDescriptionAndDocumentAttribute()
    {
        return '<p>'.$this->description.'</p>'.$this->document_display;
    }

    public function getDocumentDisplayAttribute()
    {
        if ($this->url)
        {
            return $this->url;
        }

        return '';
    }

    public function getUploaderNameAttribute()
    {
        if ($this->uploaderPerson())
        {
            return $this->uploaderPerson->name;
        }

        return '#UNKNOWN USER#';
    }

    /**
     * Makes a given document a revision of a previous one. 
     * @param type $previousDocumentID 
     * @return type
     */
    public function linkTo($previousDocumentID)
    {
        $previousDocument = Document::find($previousDocumentID);

        $this->previous_document_id = $previousDocument->id;
        $this->number_of_revisions  = $previousDocument->number_of_revisions + 1;

        $previousDocument->subsequent_document_id = $this->id;
        $previousDocument->is_revised             = 1;
        $previousDocument->number_of_revisions    = $previousDocument->number_of_revisions + 1;
        $previousDocument->current_document_id    = $this->id;

        $this->save();
        $previousDocument->save();
    }

    public function people()
    {
        return $this->morphedByMany('App\Person', 'documented');
    }

    public function uploaderPerson()
    {
        if ($this->uploaderUser)
        {
            return $this->uploaderUser->belongsTo('App\Person', 'person_id');
        }

        return null;
    }

    public function uploaderUser()
    {
        return $this->belongsTo('App\User', 'uploaded_by_id');
    }
}
