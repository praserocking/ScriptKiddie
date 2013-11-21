# script to download iQuote photos at sastra.edu
# run in linux terminal
import os
t=1
for _ in range(50):
	x="http://sastra.edu/images/sastra/iquote//I-Quote-%28"+`t`+"%29.jpg"
	y="curl "+x+" -o "+`t`+"x"+".jpg"
	os.system(str(y))
	t+=1
