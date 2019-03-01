<?php
namespace App\Traits;


trait storesMetadata {

    public function update(array $data = array(), array $options = array() )
    {      
        $data = $this->setmeta($data);
        parent::update($data); // do nothing yet
    }


   

    /**
     *   helper function that extracts metadata out of input data fields 
     *   into the meta key. note it also deletes the input data key
     */
    public function setmeta($data)
    {
        
        
        $metaFieldName = $this->metaFieldName();
        
        $metadata = $this->{$metaFieldName};
        

        $metakeys = collect( $this->metakeys() ); 
        
        $metakeys->each(function($metakey,$x) use(&$metadata,&$data) {

            

            if(isSet($data[$metakey])){
                $metadata[$metakey] = $data[$metakey];
                unSet($data[$metakey]);
            } elseif($this->meta && isSet($this->meta[$metakey] )){ // preserve any old metakey:value data
                $metadata[$metakey] = $this->meta[$metakey];

            }
       });

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