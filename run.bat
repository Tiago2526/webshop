git add -A 
 set /p commitMessage=Commit message: 
 git commit -m "%commitMessage%" 
 git push -u origin master