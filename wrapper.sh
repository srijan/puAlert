#!/bin/bash
var="Preactice Tests and CL Schedule"
while [ 1=1 ]
do
#echo $var
out="`./execPuTest.sh \"$var\"|head -n 1`"
var="$out"
echo $var
sleep 300
done



