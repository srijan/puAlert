#!/bin/bash
var="Synopsys Rescheduled"
while [ 1=1 ]
do
#echo $var
out="`./execPuTest.sh \"$var\"|head -n 1`"
var="$out"
echo $var
sleep 60
done



