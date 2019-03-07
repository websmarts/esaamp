<?php
namespace App\Traits;


trait storesMetadata {

    public function update(array $data = array(), array $options = array() )
    {      
        $data = $this->setmeta($data);

        parent::update($data); 
    }


   

    /**
     *   If the data does not contain a key == the metaFieldname (eg meta ) 
     *   then this extracts metadata out of top level input data fields 
     *   into the metadata. note it also deletes the top level input data key
     */
    public function setmeta($data)
    {
        

        $metaFieldName = $this->metaFieldName();


        // If data has a the metakey then just use that
        if(isSet($data[$metaFieldName])){
            return $data; // nothing to do if metafield is set in data
        }


        // If we get here the
        // Data does not have the metafield set so we compile
        // the meta data out of data fields whose key matches 
        // one of the models metakeys;
        
        $metadata = $this->{$metaFieldName};// the current stored metadata 
        

        $metakeys = collect( $this->metakeys() ); 
        
        $metakeys->each(function($metakey,$x) use(&$metadata,&$data) {

        // overwrite any current metadata if
        // the data supplied has a key matching one of
        // the models metakeys

        if(isSet($data[$metakey])){
            $metadata[$metakey] = $data[$metakey];
            unSet($data[$metakey]);
        } 
       });


       // Add the updated metadata to the data
       $data[$metaFieldName] = $metadata;
       
       return $data;
    }

    

    /**
     * Override this method in the Model to use a differnt fieldname
     */
    protected function metaFieldName()
    {
        return 'meta';
    }

    /**
     * Override this method in the Model to return an array of allowed metakeys
     */
    protected function metakeys()
    {
        return [];
    }
}