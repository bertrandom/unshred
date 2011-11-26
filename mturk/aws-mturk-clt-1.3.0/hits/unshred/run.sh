#!/usr/bin/env sh
#
# Copyright 2008 Amazon Technologies, Inc.
# 
# Licensed under the Amazon Software License (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at:
# 
# http://aws.amazon.com/asl
# 
# This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES
# OR CONDITIONS OF ANY KIND, either express or implied. See the
# License for the specific language governing permissions and
# limitations under the License.
 


cd ../../bin
./loadHITs.sh $@ -label ../hits/unshred/unshred -input ../hits/unshred/unshred.input -question ../hits/unshred/unshred.question -properties ../hits/unshred/unshred.properties 
cd ../hits/unshred
