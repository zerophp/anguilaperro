<?php

interface Model_Interfaces_Groups
{
                
        public function readGroups();
        public function writeGroup($group, $id);
        public function readGroup($id);
        public function removeGroup($id);        
}