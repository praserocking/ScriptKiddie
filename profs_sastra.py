# script to download all professor's images at sastra university
# Manually Delete the null images
# execute in linux terminal

import os
t=500
for _ in range(2000):
    x="http://www.sastra.edu/staffprofiles/upload/C"+`t`+".jpg"
	  y="curl "+x+" -o "+`t`+"x"+".jpg"
	  os.system(str(y))
	  t+=1
