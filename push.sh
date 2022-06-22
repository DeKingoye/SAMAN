branch="$1"
message="$2"

git add .
git commit -m"$message"
git checkout -b $branch
git push origin $branch

