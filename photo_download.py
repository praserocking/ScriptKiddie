# download images from www.sastra.edu .only 10 they have.. :(
# run in linux terminal.. chuck Windows!

import os
t=1
for _ in range(50):
	x="http://sastra.edu/images/sastra/main%20slide//00"+`t`+".jpg"
	y="curl "+x+" -o "+`t`+".jpg"
	os.system(str(y))
	t+=1
