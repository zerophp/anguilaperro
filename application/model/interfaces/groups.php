<?php

interface Model_Interfaces_Groups
{
                
        public function readGroups();
        public function writeGroup($id, $user);
        public function readGroup($id);
        public function removeGroup($id);        
}